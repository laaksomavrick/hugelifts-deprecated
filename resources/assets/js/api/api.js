import axios from 'axios'

export const getHelloWorld = () => {
    return axios.get('/api/hello')
}
