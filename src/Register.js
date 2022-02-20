import React from "react";
import Axios from "./axios";
import history from './history';

import {
    BrowserRouter as Router,
    Routes,
    Route,
    Link
} from "react-router-dom";
class Register extends React.Component{
    constructor(props) {
        super(props);
        this.state={user:{name:"",email:"",password:""}}
        this. handleSubmit = this. handleSubmit.bind(this);
    }
    handleSubmit(event)
    {
         history.push("/Room");
//        event.preventDefault()
//        this.setState(state=>{const user={name:this.element.value,email:this.element1.value,password: this.element2.value};
//            return user;})
//        Axios.post("",this.state.user)
//            .then(res=>{console.log(res)})
//            .catch(res=>{console.log(res)})
    }
    render() {
        return(
            <div className="Register">

                    <ul className="Nav">
                        <li><Link to="/Login">Login</Link></li>
                        <li><Link to="/Register">Register</Link></li>
                    </ul>

                <form  className="Register-form" action="" onSubmit={this.handleSubmit}>
                    <input  className="Register-email" type="text" placeholder="Name" ref={el => this.element = el}/>
                    <input  className="Register-email" type="email" placeholder="Email" ref={el => this.element1 = el}/>
                    <input className="Register-password" type="password" placeholder="Password" ref={el => this.element2 = el}/>
                    <button  className="Register-button" type="submit">Register</button>
                </form>
            </div>
        )
    }
}
export  default  Register;