import axios from 'axios'

export const create = data => {
    return axios.post('/api/routines', data)
}

export const get = () => {
    return axios.get('/api/routines')
}

export const update = data => {
    return axios.patch(`/api/routines/${data.id}`, data)
}

export const destroy = id => {
    return axios.delete(`/api/routines/${id}`)
}
