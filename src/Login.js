import React from "react"
import Axios from "./axios";
import {
    BrowserRouter as Router,
    Routes,
    Route,
    Link
} from "react-router-dom";
class Login extends React.Component{
    constructor(props) {
        super(props);
        this.state={user:{email:"",password:""}}
        this. handleSubmit = this. handleSubmit.bind(this);
    }
    handleSubmit(event)
    {
        event.preventDefault()
        this.setState(state=>{const user={email:this.element.value,password: this.element1.value};
        return user;})
        Axios.post("",this.state.user)
            .then(res=>{console.log(res)})
            .catch(res=>{console.log(res)})
    }
    render() {
        return(
            <div className="Login">

                        <ul>
                              <li><Link to="/Login">Login</Link></li>
                            <li><Link to="/Register">Register</Link></li>
                        </ul>

            <form  className="Login-form" action="" onSubmit={this.handleSubmit}>
                <input  className="Login-email" type="email" placeholder="Email" ref={el => this.element = el}/>
                <input className="Login-password" type="password" placeholder="Password" ref={el => this.element1 = el}/>
                <button  className="Login-button" type="submit">Login</button>
            </form>
            </div>
        )
    }
}
export  default Login;