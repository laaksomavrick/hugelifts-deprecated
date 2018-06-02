// Using Epley formula as per Wikipedia
export const getOneRepMax = (weight, reps) => {
   return Math.ceil((weight * (1 + (reps / 30))) / 5) * 5
}
