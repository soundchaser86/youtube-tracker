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
        <tr v-for="video in videos">
            <td>{{ video.name }}</td>
            <td>{{ video.channel_name }}</td>
            <td>{{ video.views_first_hour }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            videos: []
        }
    },
    created() {
        this.axios
            .get('http://youtube-tracker.test/videos/getAll')
            .then(response => {
                this.videos = response.data.data;
            });
    },
}
</script>
