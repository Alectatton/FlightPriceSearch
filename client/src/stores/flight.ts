import { defineStore } from "pinia";
import axios from "axios";
// import process from "process";

// const API_URL = process.env.API_URL;
const API_URL = 'http://127.0.0.1:8000';

export const useFlightStore = defineStore('flight', {
    state: () => ({
        flights: [],
    }),
    actions: {
        async fetchFlights(payload: any) {
            console.log('[FlightStore] fetchFlights');
            console.log(payload);

            axios.get(`${API_URL}/api/flights`, { params: payload })
                .then((response: any) => {
                    console.log("Response", response.data);
                    this.flights = response.data;
                })
                .catch((error: any) => {
                    console.error(error);
                });
        },
    },
});