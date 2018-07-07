export const formatErrors = (e) => {
    const response = e.response
    if (response && response.data && response.data.errors) {
        const obj = response.data.errors
        let errors = []
        for (let [key, value] of Object.entries(obj)) {
            errors.push(value) 
        }
        errors = errors.reduce((acc, e) => acc.concat(e), [])
        return errors
    } else if (response && response.data && response.data.error) {
        return [response.data.message]
    } else {
        return ['Oops! Something went wrong']
    }
}
