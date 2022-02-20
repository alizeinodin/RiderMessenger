import React from 'react'
import ConverstionItem from './ConverstionItem'
class ConverstionList extends React.Component{
    constructor(props)
    {
        super(props)
        this.state={Converstions:[{name:"asma",avatare:"#"},{name:"asma",avatare:"#"},{name:"asma",avatare:"#"}]}
    }
    render()
    {
        return(
        <div className="ConverstionList">
            {this.state.Converstions.map((item,index)=><ConverstionItem Name={item.name} Avatar={item.avatar} key={index}/>)}
            </div>)

    }
}
export default ConverstionList;