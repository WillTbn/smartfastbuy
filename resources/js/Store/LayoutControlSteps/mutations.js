export function setAccount (state, payload){
    // state.account = payload
}
export function setUser(state, payload){
    // state.user = payload
}
export function setAuth(state, payload){
    // state.auth = payload
}
export function setId(state, payload){
    state.id = payload
}
export function setBlock(state, payload)
{
    state.block = {...payload}
}
