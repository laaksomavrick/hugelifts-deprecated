export const textSearch = (unsafeQuery, unsafeComparison) => {
    const query = unsafeQuery.toLowerCase()
    const comparison = unsafeComparison.toLowerCase()
    const subIndex = query.length
    if (subIndex > comparison.length) { return false }
    const substring = comparison.substring(0, subIndex)
    return query === substring
}