import React, {Component} from "react";
import {Link} from "react-router-dom"

class Header extends Component {
  constructor(props) {
    super(props);
    this.state = {
        menuItems: [],
        hamburgerActive: false
    }
    this.getLocation = this.getLocation.bind();
    this.toggleHamburger = this.toggleHamburger.bind(this);
    this.closeHamburger = this.closeHamburger.bind(this);
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

  toggleHamburger(e) {
    e.preventDefault();
    console.log("toggling menu");
    this.setState( state => ({hamburgerActive: !state.hamburgerActive}));
  }

  closeHamburger(e) {
    //e.preventDefault();
    console.log("closing menu");
    this.setState( state => ({hamburgerActive: false}));
  }

  render() {
    var comp = this;
    var menuClass = this.state.hamburgerActive ? "navbar-menu is-active" : "navbar-menu";
    return (
      <nav className="navbar is-primary">
        <div className="container has-text-centered">
          <div className="navbar-brand">
            <p className="is-size-3">
              <Link to="/" className="has-text-white">
                {this.props.meta.siteName}
              </Link>
            </p>

            <a role="button" className="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample" onClick={this.toggleHamburger}>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
              <span aria-hidden="true"></span>
            </a>
          </div>
          <div id="navbarBasicExample" className={menuClass}>
            <div className="navbar-start">
              
              {this.state.menuItems.map(menu=>( 
                <Link to={`${this.getLocation(menu.url).pathname}`} className="navbar-item" onClick={comp.closeHamburger}>
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
