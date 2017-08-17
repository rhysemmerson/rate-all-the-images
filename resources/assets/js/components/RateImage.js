import React, {Component} from "react"
import {ENDPOINT_URL} from "../constants"

const rateImage = (image, rating) => {
    return axios.post(ENDPOINT_URL+"/ratings", {
        image_id: image.id,
        rating: rating
    })
}

export default class extends Component {
    constructor(props) {
        super(props)
    }

    render() {
        let {image, rating, onComplete} = this.props

        let thumbsUpClass = ["RateImage__thumbs-up btn"],
            thumbsDownClass = ["RateImage__thumbs-down btn"]

        let thumbsDownProps = {},
            thumbsUpProps = {}

        if (rating === "0" || rating === 0) {
            thumbsDownClass.push("btn-danger")
        } else if (rating === 1 || rating === "1") {
            thumbsUpClass.push("btn-success")
        }

        let clickThumbsUpDown = _rating => ev => {
            ev.preventDefault()

            rateImage(image, _rating)
                .then(response => {
                    let rating = response.data
                    if (onComplete !== null) {
                        onComplete(rating)
                    }
                })
        }

        if (rating !== null) {
            thumbsDownProps.disabled = thumbsUpProps.disabled = "true"
            thumbsDownProps.onClick = thumbsUpProps.onClick = ev => ev.preventDefault()
        } else {
            thumbsUpProps.onClick = clickThumbsUpDown(1)
            thumbsDownProps.onClick = clickThumbsUpDown(0)
            thumbsDownClass.push("btn-default")
            thumbsUpClass.push("btn-default")
        }

        return (
            <div className="RateImage">
                <div className="RateImage__image"><img className="RateImage__image__img" src={image.image_url} /></div>

                <div className="RateImage__buttons">
                    <a href="" className={thumbsDownClass.join(' ')} {...thumbsDownProps}>
                        <span className="glyphicon glyphicon-thumbs-down"></span>
                    </a>
                    <a href="" className={thumbsUpClass.join(' ')} {...thumbsUpProps}>
                        <span className="glyphicon glyphicon-thumbs-up"></span>
                    </a>
                </div>
            </div>
        )
    }
}
