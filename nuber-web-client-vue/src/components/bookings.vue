<template>
    <div>
        <div v-if="isLoading">Loading Bookings...</div>
        <div v-else>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>refrence</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Car Type</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="booking in bookings">
                    <tr v-bind:key="booking.id">
                        <td>{{ booking.id }}</td>
                        <td>{{ booking.name }}</td>
                        <td>{{ booking.email }}</td>
                        <td>{{ booking.address }}</td>                        
                        <td>{{ booking.car_type }}</td>
                        <td>{{ booking.status}}</td>
                        <td>{{ booking.created_at}}</td>
                        <td>{{ booking.updated_at}}</td>
                    </tr>
                </template>
            </tbody>
        </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'

export default {
    data() {
        return {
            isLoading: true,
            bookings: {}
        }
    },
    created() {
        this.getBooking()
        this.interval = setInterval(() => this.getBooking(), 5000);
    },
    methods: {
        async getBooking() {
            axios.get(API_BASE_URL + '/bookings')
                .then(response => {
                    this.bookings = response.data.data
                    this.isLoading = false
                })
                .catch(error => {
                    // handle authentication and validation errors here
                    this.errors = error.response.data.errors
                    this.isLoading = false
                })
        }
    }
}
</script>