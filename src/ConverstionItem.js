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
            <img className="Avatar" src="#" alt="avatar"/>
            <p className="Name">asma</p> </div>
        );
    }
}
export default ConverstionItem;