import axios from 'axios'

export const create = data => {
    return axios.post('/api/token', data)
}
