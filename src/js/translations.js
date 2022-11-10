import getLodash from 'lodash/get'
import eachRightLodash from 'lodash/eachRight'
import replaceLodash from 'lodash/replace'

export default function(string, args){
    const key = string.substr(0, string.indexOf('.'))
    const originalString = string

    if (!key || window.i18n.__possible_keys.includes(key)) {
        string = '__global.' + string
    }
    let value = getLodash(window.i18n, string)
    if (!value) {
        value = originalString
    }

    eachRightLodash(args, (paramVal, paramKey) => {
        value = replaceLodash(value, `:${paramKey}`, paramVal)
    })

    return value
}
