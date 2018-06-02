import axios from 'axios'

export const create = data => {
    return axios.post('/api/exercises', data)
}

export const get = () => {
    return axios.get('/api/exercises')
}
