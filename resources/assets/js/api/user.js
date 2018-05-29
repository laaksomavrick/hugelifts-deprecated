import axios from 'axios'

export const create = data => {
    return axios.post('/api/user', data)
}

export const get = () => {
    return axios.get('/api/user')
}
