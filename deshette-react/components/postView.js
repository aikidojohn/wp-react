import React, {Component} from "react";
import ReactDOM from "react-dom";
import {Link} from "react-router-dom";
import "whatwg-fetch";

class PostView extends Component {
    constructor(props) {
        super(props);
        this.state = {
            post: {}
        }
        this.createMarkup = this.createMarkup.bind();
    }

    componentDidMount() {
        const slug = this.props.match.params.slug;
        window.fetch(`/wp-json/wp/v2/posts?slug=${slug}&_fields=id,title,slug,content`)
            .then((response) => {
                return response.json();
            }).then((posts) => {
                console.log('parsed json', posts);
                this.setState({
                    post: posts[0]
                });
            }).catch(function(ex) {
                console.log('parsing failed', ex);
            });
    }

    createMarkup(html) {
        return {__html: html};
    }
    render() {
        let build;
        if (this.state.post.title) {
            build =(
            <div>
                <h3>{this.state.post.title.rendered}</h3>
                <div
                    dangerouslySetInnerHTML={this.createMarkup(this.state.post.content.rendered)}
                />
            </div>);
        } else {
            build = <div />
        }
        return build;
    }
}

export default PostView;