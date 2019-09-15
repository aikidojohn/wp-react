import React, {Component} from "react";
import {Link} from "react-router-dom"

class Header extends Component {
  constructor(props) {
    super(props);
    this.state = {
        menuItems: []
    }
    this.getLocation = this.getLocation.bind();
  }

  componentDidMount() {
    window.fetch('/wp-json/menus/v1/locations/header-menu')
        .then((response) => {
            return response.json();
        }).then((json) => {
            console.log('parsed json', json);
            this.setState({
                menuItems: json.items
            });
        }).catch(function(ex) {
            console.log('parsing failed', ex);
        });
  }

  getLocation(href) {
    var l = document.createElement("a");
    l.href = href;
    return l;
  }

  render() {
    return (
      <nav className="navbar is-primary">
        <div className="container has-text-centered">
          <div className="navbar-brand">
            <p className="is-size-3">
              <Link to="/" className="has-text-white">
                {this.props.meta.siteName}
              </Link>
            </p>

            <a role="button" className="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>
          <div id="navbarBasicExample" className="navbar-menu">
            <div className="navbar-start">
              {this.state.menuItems.map(menu=>( 
                <Link to={`${this.getLocation(menu.url).pathname}`} className="navbar-item">
                  {menu.title}
                </Link>
              ))}
            </div>
          </div>
        </div>
      </nav>
    );
  }
}
export default Header;
