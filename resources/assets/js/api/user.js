import axios from 'axios'

export const create = async data => {
    return axios.post('/api/user', data)
}
