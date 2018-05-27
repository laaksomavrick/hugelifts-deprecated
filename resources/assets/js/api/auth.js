import axios from 'axios'

export const authenticate = data => {
    return axios.post('/api/token/authenticate', data)
}
