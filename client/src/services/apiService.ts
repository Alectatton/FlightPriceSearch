import axios from 'axios'

const apiClient = axios.create({
    baseURL: 'http://localhost:8000/api',
    withCredentials: false,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    },
    timeout: 10000,
});

export default {
    getFlights(payload: any) {
        return apiClient.get('/flights', { params: payload });
    },
};
