export const formatErrors = (e) => {
    if (e && e.data && e.data.errors) {
        const obj = e.data.errors
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
