<template>
    <div>
        <input v-model="filterName" @keyup.enter="getAll()"/>
        <button v-on:click="getAll()">Search</button>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Channel</th>
            <th scope="col">Views in first hour</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="video in data.data">
            <td>{{ video.name }}</td>
            <td>{{ video.channel_name }}</td>
            <td>{{ video.views_first_hour }}</td>
        </tr>
        </tbody>
    </table>

    <Pagination :data="data" @pagination-change-page="getAll"/>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
    components: {
        'Pagination': LaravelVuePagination
    },
    data() {
        return {
            data: {},
            filterName: null,
        }
    },
    methods: {
        getAll(page = 1) {
            let filter = {};
            let filterString = '';

            if (this.filterName) {
                filter.name = this.filterName;
            }

            for (let key in filter) {
                filterString += '&' + key + '=' + filter[key];
            }

            this.axios
                .get('http://youtube-tracker.test/videos/getAll?page=' + page + filterString)
                .then(response => {
                    this.data = response.data;
                });
        }
    },
    mounted() {
        this.getAll();
    },
}
</script>
