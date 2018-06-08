import axios from 'axios'

export const get = () => {
    return axios.get('/api/schedule')
}

export const update = data => {
    return axios.patch(`/api/schedule/${data.id}`, data)
}
