import React, {Component} from "react"
import { ENDPOINT_URL } from "../constants"
import RateImage from "../components/RateImage"

export default class extends Component{

    constructor(props) {
        super(props)

        this.state = {
            ratings: []
        }
    }

    componentDidMount() {

        axios.get(ENDPOINT_URL+"/ratings", {responseType: "json"})
            .then((response) => {
                this.setState({
                    ratings: _.get(response, "data.data", [])
                })
            })
    }

    render() {

        let images = this.state.ratings.map((rating) => {
            return (
                <div className="Ratings__image-col" key={rating.id}>
                    <RateImage image={rating.image} rating={rating.rating} />
                </div>
            )
        })

        let nomeows = (
            <h1 className="no-meows">You haven't rated any meows yet</h1>
        )

        let content = images.length ? images : nomeows

        return (
            <div className="Ratings">
                <div className="container">
                    <div className="Ratings__list">
                        {content}
                    </div>
                </div>
            </div>
        )
    }
}