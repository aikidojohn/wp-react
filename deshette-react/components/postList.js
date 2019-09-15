import React, {Component} from "react";
import ReactDOM from "react-dom";
import {Link} from "react-router-dom";
import "whatwg-fetch";

class PostList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            posts: []
        }
        this.createMarkup = this.createMarkup.bind();
    }

    componentDidMount() {
        window.fetch('/wp-json/wp/v2/posts?_fields=id,title,slug,excerpt')
            .then((response) => {
                return response.json();
            }).then((posts) => {
                console.log('parsed json', posts);
                this.setState({
                    posts: posts
                });
            }).catch(function(ex) {
                console.log('parsing failed', ex);
            });
    }

    createMarkup(html) {
        return {__html: html};
    }
    render() {
        return(
            <div>
                {this.state.posts.map(post=>(
                    <Link to={`${post.slug}`} key={post.id}>
                        <div className="card" key={post.id}>
                            <div className="card-content">
                                <h3>{post.title.rendered}</h3>
                                <div
                                    dangerouslySetInnerHTML={this.createMarkup(post.excerpt.rendered)}
                                />
                            </div>
                        </div>
                    </Link>
                ))}
            </div>
        );
    }
}

export default PostList;