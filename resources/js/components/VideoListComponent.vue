<template>
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

    <Pagination :data="data" @pagination-change-page="getAll" />
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
        }
    },
    methods: {
        getAll(page = 1) {
            this.axios
                .get('http://youtube-tracker.test/videos/getAll?page=' + page)
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
