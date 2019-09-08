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
      siteName: "",
      siteDescription: "",
      pageMap: {}
    }
  }

  componentDidMount(){
    window.fetch('/wp-json?_fields=name,description')
          .then((response) => {
              return response.json();
          }).then((json) => {
              console.log('parsed json', json);
              this.setState({
                  siteName: json.name,
                  siteDescription: json.description,
              });
          }).catch(function(ex) {
              console.log('parsing failed', ex);
          });
    /*window.fetch('/wp-json/wp/v2/pages?')
          .then((response) => {
              return response.json();
          }).then((json) => {
              console.log('parsed json', json);
              this.setState({
                  page: json[0]
              });
          }).catch(function(ex) {
              console.log('parsing failed', ex);
          });*/
  }

  render() {
    return (
      <Router>
      <div>
        <Header siteName={this.state.siteName} siteDescription={this.state.siteDescription}/>
        <section className="section container content">
          <Switch>
          <Route exact path="/" component={PostList} />
          <Route exact path="/posts/:slug" component={PostView} />
          <Route exact path="/:slug" component={PageView} />
          </Switch>
        </section>
      </div>
      </Router>
    );
  }
}

ReactDOM.render(<App />, document.getElementById("app"));
