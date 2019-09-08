import React, {Component} from "react";
import ReactDOM from "react-dom";
import {Link} from "react-router-dom";
import "whatwg-fetch";

class PageView extends Component {
    constructor(props) {
        super(props);
        this.state = {
            post: {}
        }
        this.createMarkup = this.createMarkup.bind();
    }

    componentDidMount() {
        console.log("mounted pageview");
        const slug = this.props.match.params.slug;
        window.fetch(`/wp-json/wp/v2/pages?slug=${slug}`)
            .then((response) => {
                return response.json();
            }).then((json) => {
                console.log('parsed json', json);
                this.setState({
                    page: json[0]
                });
            }).catch(function(ex) {
                console.log('parsing failed', ex);
            });
    }

    componentDidUpdate() {
        console.log("Component Update");
    }

    createMarkup(html) {
        return {__html: html};
    }

    render() {
        let build;
        if (this.state.page) {
            build =(
            <div>
                <h3>{this.state.page.title.rendered}</h3>
                <div
                    dangerouslySetInnerHTML={this.createMarkup(this.state.page.content.rendered)}
                />
            </div>);
        } else {
            build = <div />
        }
        return build;
    }
}

export default PageView;