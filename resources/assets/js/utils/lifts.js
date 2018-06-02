// Using Epley formula as per Wikipedia
export const getOneRepMax = (weight, reps) => {
    if (reps === 1) {
        return weight
    }
    return Math.ceil((weight * (1 + (reps / 30))) / 5) * 5
}
