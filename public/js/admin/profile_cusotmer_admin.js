axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
 
var manage_service = new Vue({
    el: '#profile_customer   ',

    data: {
        users: {},
        token: {},
        items: [],
        date:{},
        showDepartments:{},
        showBills:{},
        showImages:{},
        customer_id: {'customer_id': ''},
        showBillDetails: {},
        isLoadCustomer: false
    },
    
    mounted : function(){
        this.users = Vue.ls.get('user', {});
        this.token = Vue.ls.get('token', {});
        this.showInfor();
    },

    methods: {
        showInfor: function() {
            var authOptions = {
                method: 'get',
                url: '/api/v0/filter-customer',
                params: this.params,
                headers: {
                    'Authorization': "Bearer " + this.token.access_token
                }
            }  
            axios(authOptions).then(response => {
                this.$set(this, 'items', response.data.data.data);
                this.renderPages(response.data.data.total);
            }).catch(error => {
                this.dataPages = [1];
            });
        },

        viewUser: function(item) {
            this.fillItem.id = item.id;
            this.fillItem.name = item.name;
            this.fillItem.email = item.email;
            this.fillItem.phone = item.phone;
            this.fillItem.gender = item.gender;
            this.fillItem.about = item.about_me;
            this.fillItem.email = item.email;
            this.fillItem.birthday = item.birthday;
            this.fillItem.permission = item.permission;
            this.showImage(this.fillItem.id);
            this.showBill(item.id);
            $('#showUser').modal('show');
        },

        showImage: function(customer_id) {
            this.customer_id.customer_id = customer_id;
            var self = this;
            var authOptions = {
                    method: 'GET',
                    url: ' /api/v0/bill-by-customer-id-with-images',
                    params: this.customer_id,
                    headers: {
                        'Authorization': "Bearer " + this.token.access_token,
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    json: true
                }
            axios(authOptions).then((response) => {
                this.$set(this, 'showImages', response.data.data);
                for (var i = 0; i < this.showImages.length; i++) {
                    var dateFormat = ((this.showImages[i].created_at).slice(0, 10));
                    this.date = this.frontEndDateFormat(dateFormat);
                }
                
            }).catch((error) => {
            });
        },

        showBill: function(id) {

            this.customer_id.customer_id = id;
            var self = this;
            var authOptions = {
                    method: 'GET',
                    url: '/api/v0/list-bill-by-customer-id',
                    params: this.customer_id,
                    headers: {
                        'Authorization': "Bearer " + this.token.access_token,
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    json: true
                }

            axios(authOptions).then((response) => {
                this.$set(this, 'showBills', response.data.data);
                console.log(response.data.data.length);
            }).catch((error) => {
                if (error.response.status == 403) {
                    self.formErrors = error.response.data.message;
                    for (key in self.formErrors) {
                        toastr.error(self.formErrors[key], '', {timeOut: 10000});
                    }    
                }
            });
        },

        viewBill: function(id) {
            var self = this;
            var authOptions = {
                    method: 'GET',
                    url: '/api/v0/bill/' + id,
                    headers: {
                        'Authorization': "Bearer " + this.token.access_token,
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    json: true
                }

            axios(authOptions).then((response) => {
                this.$set(this, 'showBillDetails', response.data.data);
                var date = (this.showBillDetails.created_at).slice(0, 10);
                this.showBillDetails.date = this.frontEndDateFormat(date);
                $("#showBill_Detail").modal("show");
            }).catch((error) => {
                    toastr.error('error', '', {timeOut: 10000});
            });
        },
        frontEndDateFormat: function(date) {
            return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },
        backEndDateFormat: function(date) {
            return moment(date, 'DD/MM/YYYY').format('YYYY-MM-DD');
            },
        hideBill: function(){
            $("#showBill_Detail").modal("hide");
            $("#showUser").modal("show");
        },
    }
});
