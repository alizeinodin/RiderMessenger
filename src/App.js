import logo from './logo.svg';
import './App.css';
import Login from "./Component/Login";
import Register from "./Component/Register";
import history from './Component/history';
import Room from './Component/Room';
import {
  BrowserRouter as Router,
  Routes,
  Route,
  Link
} from "react-router-dom";
function App() {
  return (
    <div className="App">
      <Router history={history}>
             <Routes>
                 <Route  exact path='/' element={<Login/>}  />
                 <Route  exact path='/Login' element={<Login/>}  />
                 <Route exact path="/Register" element={< Register/>} />
                 <Route exact path="/Room" element={< Room/>} />
                 </Routes>
       </Router>
    </div>
  );
}

export default App;
