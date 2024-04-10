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
import axios from 'axios';
    export default {
        data() {
            return {
                reports: []
            }
        },
        methods: {
            deleteReport(report) {
                let data = new FormData();
                data.append('Report_ID',report.id);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=deleteReport`, data)
                    .then(response => {
                        console.log(response.data.message);
                        if(response.data.success) {
                          this.fetchReports();
                        }
                    })
                    .catch(error => {
                        console.error('Error Deleting Report:', error);
                    });
            },
            showContent(report) {
                alert(report.content);
            },
            fetchReports(){
                function transformReport(report) {

                    return {
                        id: report.report_id,
                        username: report.fullName,
                        email: report.email,
                        content: report.message
                    };
                }

                axios.get(`http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=getReports`)
            .then(response => {
                
                let result = response.data;
                result = result.map(report=>transformReport(report));
                this.reports = result;
                
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
            }
        },
        mounted() {
            this.fetchReports();
        },
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