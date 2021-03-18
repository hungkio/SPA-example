const axios = require('axios').default;
const api_url = 'http://localhost:8000/api/'
export default {
    getHeaders() {
        let token = window.localStorage.getItem('token');
        if (!token) {
            return {};
        }
        return {'Authorization': 'Bearer ' + token};
    },

    get(url) {
        return axios.get(api_url + url,
            {
                headers: this.getHeaders()
            })
    },

    post(url, data) {
        return axios.post(
            api_url + url,
            data,
            {
                headers: this.getHeaders()
            }
        )
    }
}