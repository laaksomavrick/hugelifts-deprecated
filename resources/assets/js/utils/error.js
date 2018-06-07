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
    } else {
        return ['Oops! Something went wrong']
    }
}
