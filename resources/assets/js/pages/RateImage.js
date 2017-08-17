import React, {Component} from "react"
import {ENDPOINT_URL} from "../constants"
import RateImage from "../components/RateImage"
import Loading from "../components/Loading"

export default class extends Component {

    constructor(props) {
        super(props)

        this.state = {
            image: null,
            error: null
        }

        this.onCompleteRate = this.onCompleteRate.bind(this)
    }

    componentDidMount() {
        this.loadRandomImage()
    }

    render(){
        let content

        let {image, error} = this.state

        if (image !== null) {
            content = <RateImage
                        image={image}
                        onComplete={this.onCompleteRate}
                        rating={null}
                        />
        } else if (error !== null) {
            content = <h1>{error}</h1>
        } else {
            content = <Loading />
        }

        return (
            <div className="rate-image">
                {content}
            </div>
        )
    }

    onCompleteRate(rating) {
        this.setState({
            image: null
        })

        this.loadRandomImage()
    }

    loadRandomImage() {
        return axios.get(ENDPOINT_URL+"/images/random", {responseType: "json"})
            .then(response => {
                if (_.get(response, 'data.error') === "no-more-images") {
                    this.setState({
                        error: _.get(response, "data.message")
                    })
                    return
                }

                this.setState({
                    image: response.data,
                    error: null
                })
            })
    }

}