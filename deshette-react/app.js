import React, {Component} from "react";
import ReactDOM from "react-dom";
import {BrowserRouter as Router, Route, Switch} from "react-router-dom";
import PostList from "./components/postList";
import PostView from "./components/postView";
import PageView from "./components/pageView";
import Header from "./components/header";

class DebugRouter extends Router {
  constructor(props){
    super(props);
    console.log('initial history is: ', JSON.stringify(this.history, null,2))
    this.history.listen((location, action)=>{
      console.log(
        `The current URL is ${location.pathname}${location.search}${location.hash}`
      )
      console.log(`The last navigation action was ${action}`, JSON.stringify(this.history, null,2));
    });
  }
}

class App extends Component {
  constructor(props) {
    super(props);
    console.log("app constructed")
    this.state = {
      meta: {
        siteName: "",
        siteDescription: "",
        siteMap: []
      }
    }
  }

  componentDidMount(){
    console.log("mounting app")
    window.fetch('/wp-json?_fields=name,description')
          .then((response) => {
              return response.json();
          }).then((json) => {
              console.log('parsed json', json);
              let oldMeta = this.state.meta;
              this.setState({
                meta: {
                  siteName: json.name,
                  siteDescription: json.description,
                  siteMap: oldMeta.siteMap
                }
              });
          }).catch(function(ex) {
              console.log('parsing failed', ex);
          });
    window.fetch('/wp-json/wp/v2/pages?_fields=slug')
          .then((response) => {
              return response.json();
          }).then((json) => {
              console.log('parsed json', json);
              let oldMeta = this.state.meta;
              this.setState({
                  meta: {
                    siteName: oldMeta.siteName,
                    siteDescription: oldMeta.siteDescription,
                    siteMap: json.map(p => p.slug)
                  }
              });
          }).catch(function(ex) {
              console.log('parsing failed', ex);
          });
  }

  render() {
    return (
      <Router>
      <div>
        <Header meta={this.state.meta}/>
        <section className="section container content">
          <Switch>
          <Route exact path="/" component={PostList} />
          <Route path="/:slug" render={(props) => <PageView {...props} meta={this.state.meta} />} />
          </Switch>
        </section>
      </div>
      </Router>
    );
  }
}

ReactDOM.render(<App />, document.getElementById("app"));
