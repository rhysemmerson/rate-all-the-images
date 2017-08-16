import React from "react"

export default React.createClass({

    componentDidMount() {
        this.setState({
            ratings: []
        })
    },

    render() {

        let images = this.state.ratings.forEach((rating) => {
            return (
                <div className="col-sm-4">
                    <img src={_.get(rating, 'image.image_url')} />
                </div>
            )
        })

        return (
            <h1>Ratings</h1>
            {images}
        )
    }
})