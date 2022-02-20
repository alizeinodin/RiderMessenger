import axios from "axios";
const Axios = axios.create({
    baseURL: 'http://localhost',
});
Axios.defaults.withCredentials = true;

export default Axios;

Axios.get('/sanctum/csrf-cookie').then( (res => {
    console.log(res);
}))
