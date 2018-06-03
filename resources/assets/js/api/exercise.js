import axios from 'axios'

export const create = data => {
    return axios.post('/api/exercises', data)
}

export const get = () => {
    return axios.get('/api/exercises')
}

export const update = data => {
    return axios.patch(`/api/exercises/${data.id}`, data)
}

export const destroy = id => {
    return axios.delete(`/api/exercises/${id}`)
}
