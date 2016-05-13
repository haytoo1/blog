var register = {
    acctoun:'',
    password:'',
    repassword:'',
    fetch : function () {
        this.acctoun = $("[name=account]").val();
        this.password = $("[name=password]").val();
        this.repassword = $("[name=repassword]").val();
    }
}
