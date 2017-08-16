import React from "react"
import ReactDOM from "react-dom"
import {
    BrowserRouter as Router,
    Route,
    Link
} from 'react-router-dom'

import RateImage from "./pages/RateImage"
import Ratings from "./pages/Ratings"
import Menu from "./components/Menu"

require('./bootstrap')

ReactDOM.render((
    <Router>
        <div>
            <Menu>
                <Link to="/">Home</Link>
                <Link to="/ratings">My Ratings</Link>
            </Menu>
            <Route exact path="/" component={RateImage} />
            <Route exact path="/ratings" component={Ratings} />
        </div>
    </Router>
), document.getElementById('app'))