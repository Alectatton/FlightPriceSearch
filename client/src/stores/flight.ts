import { defineStore } from "pinia";
import api from "../services/apiService";

export const useFlightStore = defineStore('flight', {
    state: () => ({
        flights: [],
        loading: false,
    }),
    actions: {
        async fetchFlights(payload: any) {
            this.loading = true;

            api.getFlights({ params: payload })
                .then((response: any) => {
                    this.flights = response.data.data;
                })
                .catch((error: any) => {
                    console.error(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
});