import React from 'react'
class ConverstionItem extends React.Component{
    constructor(props)
    {
        super(props)
        this.state={info:{name:"Asma" ,avatar:"#"}}
        
    }
//    componentDidMount()
//    {
//        
//    }
    render()
    {
        return(
            <div className="ConverstionItem">
            <img className="Avatar" src={this.props.Avatar} alt="avatar"/>
            <p className="Name">{this.props.Name}</p> </div>
        );
    }
}
export default ConverstionItem;