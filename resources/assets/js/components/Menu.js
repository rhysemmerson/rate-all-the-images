import React from "react"

export default (props) => {
    let links = props.children.map((link, i) => (
        <li key={i}>{link}</li>
    ))

    return (
        <nav className="navbar navbar-default navbar-fixed-top">
            <div className="container-fluid">
                <div className="navbar-header">
                    <a className="navbar-brand" href="/app">Meowzers</a>
                </div>
                <div className="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul className="nav navbar-nav">
                        {links}
                    </ul>
                </div>
            </div>
        </nav>
    )
}