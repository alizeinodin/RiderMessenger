import React from "react";
import Moment from "react-moment";
class Message extends React.Component{

    constructor(props) {
        super(props);
//        this.state={date:new Date(),text:"salam"};
    }
    render() {

        return(
        <div className="Message">
            <p className="Message-text">{this.props.text}</p>
            <Moment className="Message-time" format="hh:mm">{this.props.date}</Moment>
        </div>)
    }

}
export default Message;