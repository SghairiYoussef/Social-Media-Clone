<template>
    <div class="table-container">
        <table class="table table-dark table-hover table-striped">
            <thead>
                <tr>
                    <th>report_ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="report in reports" :key="report.id">
                    <td>{{ report.id }}</td>
                    <td>{{ report.username }}</td>
                    <td>{{ report.email }}</td>
                    <td>
                        <button @click="showContent(report)" class="btn btn-outline-secondary">Read Content</button>
                    </td>
                    <td>
                        <button @click="deleteReport(report)" class="btn btn-outline-secondary">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                reports: [
                    {
                        id: 1,
                        username: 'User 1',
                        email: 'john@example.com',
                        content: 'This is a report from user 1'
                    },
                ]
            }
        },
        methods: {
            editReport(report) {
                console.log('Edit report', report);
            },
            deleteReport(report) {
                console.log('Delete report', report);
            },
            showContent(report) {
                alert(report.content);
            }
        },
        /*mounted() {
            fetch('http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=getReports')
                .then(response => response.json())
                .then(data => {
                    this.reports = data;
                });
        },*/
        name: 'reportSection'
    }
</script>
<style>
    .table {
        width: 90%;
        margin: 20px auto;
        margin-top:10px auto ;
    }
    .table-container {
        margin-right: 40px;
        background-color: #A37A74;
        color: black;
        padding: 20px;
        border-radius: 20px;
    }
</style>