import React from "react"
import Message from "./Message";
class Room extends React.Component{
    constructor(props) {
        super(props);
        this.state={data:[]}
        this.handleSub = this.handleSub.bind(this);
    }
    handleSub(event)
    {
        event.preventDefault();
        this.setState(state =>{ const data = [...state.data, {text:this.element.value,date: new Date()}];
            this.element.value=""
            return {
                data,

            };})
    }
    render(){
        return(
            <div>
                <form onSubmit={this.handleSub}>
                    <input id="a" type="text" ref={el => this.element = el} />
                    <button>send</button>
                </form>
                <div>
                    {this.state.data.map((item,index)=>(<Message key={index} text={item.text} date={item.date}></Message>))}
                </div>
            </div>
        )
    }
}
export default Room;