<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow" style="font-size:12px;">
    <div class="main-menu-content">
      <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
        <li class=" navigation-header">
          <span>General</span><i data-toggle="tooltip" data-placement="right" data-original-title="General"
          class="ft-minus"></i>
        </li>
        <li class="nav-item"><a href="<?php echo base_url();?>"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>
       	
     <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Manage Core Setting</span></a>
          <ul class="menu-content">
          <?php if($this->session->userdata('role')==1){;?>
            <li><a href="<?php echo base_url('smartadmin/Setting/addCompany');?>" class="menu-item">Company Master</a></li>
            <?php }?>
            <?php if($this->session->userdata('role')==2){;?>
            <li><a href="<?php echo base_url('admin/Setting/addBranch');?>" class="menu-item">Company Branch Master</a></li>
            <li><a href="<?php echo base_url('admin/Setting/BranchList');?>" class="menu-item">Company Branch List</a></li>
            <?php }?>
            <?php if($this->session->userdata('role')==3){;?>
            <li><a href="<?php echo base_url('branchadmin/Setting/addDepartment');?>" class="menu-item">Department Master</a></li>
            <li><a href="<?php echo base_url('branchadmin/Setting/addDesignation');?>" class="menu-item">Designation Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/addGrade');?>" class="menu-item">Grade Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/addIndustry');?>" class="menu-item">Industry Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/addBank');?>" class="menu-item">Bank</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/addBankBranch');?>" class="menu-item">Bank Branch Master</a></li>
            
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Salary Component</span></a>
          <ul class="menu-content">
          
              
             <li><a href="<?php echo base_url('branchadmin/Setting/addAllowance');?>" class="menu-item">Allowance Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/addDeduction');?>" class="menu-item">Deduction Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/GradeBaseSalary');?>" class="menu-item">Grade Base Salary</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/addTaxMaster');?>" class="menu-item">Income Tax</a></li>
             <li><a href="<?php echo base_url('branchadmin/Setting/GSTMaster');?>" class="menu-item">GST Tax</a></li>
             
             
           
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Client &amp; Services</span></a>
          <ul class="menu-content">
          
              
             <li><a href="<?php echo base_url('branchadmin/Setting/addService');?>" class="menu-item">Services Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/UploadExcels/clientEmpAttendance');?>" class="menu-item">Client Employee Attendance</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/addClient');?>" class="menu-item">Client Master</a></li>
              <li><a href="<?php echo base_url('branchadmin/UploadExcels/clientList');?>" class="menu-item">Export/Import Client</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/ClientServiceMap');?>" class="menu-item">Client Services Mapping</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/QuickInvoice');?>" class="menu-item">Quick Generate Invoice</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/generateInvoice');?>" class="menu-item">Generate Invoice</a></li>
              <li><a href="<?php echo base_url('branchadmin/Employee/generateClientBasedSalary');?>" class="menu-item">Generate Salary</a></li>
              <li><a href="<?php echo base_url('branchadmin/UploadExcels/attendanceList');?>" class="menu-item">Client Base Attendance</a></li>
               <li><a href="<?php echo base_url('Web/outStandingAmount');?>" class="menu-item">Opening Balance</a></li> 
           <li><a href="<?php echo base_url('Web/outStandingAmountTransactionReports');?>" class="menu-item">Opening Balance Transaction Reports</a></li>
          </ul>
        </li>
        
       <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Manage Employee</span></a>
          <ul class="menu-content">
          
              <li><a href="<?php echo base_url('branchadmin/Employee/create');?>" class="menu-item">Create Employee</a></li>
              <li><a href="<?php echo base_url('Web/employeeList');?>" class="menu-item">Employees List</a></li>
              <li><a href="<?php echo base_url('branchadmin/UploadExcels/uploadExcelOfSelfEmployee');?>" class="menu-item">Export/Import Employee Attendance</a></li>
              <li><a href="<?php echo base_url('branchadmin/Employee/MusterRollAttendance');?>" class="menu-item">Muster Roll Attendance</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/MusterRollAttendanceReport');?>" class="menu-item">Attendance Report</a></li>
           <li><a href="<?php echo base_url('branchadmin/UploadExcels/empList');?>" class="menu-item">Export/Import Employee</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/generateSalary');?>" class="menu-item">Generate Salary</a></li>
          <!-- <li><a href="<?php echo base_url('branchadmin/Employee/texInvoiceF');?>" class="menu-item">Tex Invoice 1</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/texInvoiceS');?>" class="menu-item">Tex Invoice 2</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/texInvoiceT');?>" class="menu-item">Tex Invoice 3</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/texInvoiceIV');?>" class="menu-item">Tex Invoice 4</a></li>-->
          </ul>
        </li>
        <li class="nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Manage Loan/Extra</span></a>
          <ul class="menu-content">
          
              <li><a href="<?php echo base_url('branchadmin/Setting/addExtraDeduction');?>" class="menu-item">Extra Deduction Master</a></li>
             <li><a href="<?php echo base_url('branchadmin/Employee/CreateLoan');?>" class="menu-item">Extra Deduction</a></li>
             <li><a href="<?php echo base_url('branchadmin/UploadExcels/uploadextradeduction');?>" class="menu-item">Bulk Extra Deduction</a></li>
             <li><a href="<?php echo base_url('Reports/loanAdvance');?>" class="menu-item">Extra Deduction Report</a></li>
              
           
          </ul>
        </li>
       
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">HR Department</span></a>
          <ul class="menu-content">
          
              <li><a href="<?php echo base_url('branchadmin/Hresource/applicationForm');?>" class="menu-item">Create Application</a></li>
              <li><a href="<?php echo base_url('branchadmin/Hresource/generateLetters');?>" class="menu-item">Generate Letter</a></li>
              <li><a href="<?php echo base_url('branchadmin/Hresource/printLetter');?>" class="menu-item">Print Letter</a></li>
              
              
           
          </ul>
        </li>
        <li class="nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Reports</span></a>
          <ul class="menu-content">
          
              
          <li><a href="<?php echo base_url('Reports/reportEPF');?>" class="menu-item">Deduction Report</a></li>
          <li><a href="<?php echo base_url('Reports/allowanceReport');?>" class="menu-item">Allowance Report</a></li>
          <li><a href="<?php echo base_url('Reports/extraDeduction');?>" class="menu-item">Extra Deduction Report</a></li>
          
          <li><a href="<?php echo base_url('Reports/empAttendanceList');?>" class="menu-item">Attendance List</a></li>
          <li><a href="<?php echo base_url('Reports/ListOfSalary');?>" class="menu-item">Salary Summary List</a></li>
          <li><a href="<?php echo base_url('Reports/ListOfSalaryAsClient');?>" class="menu-item">Salary As Client</a></li>
          <li><a href="<?php echo base_url('Reports/ListOfClientShiftSalary');?>" class="menu-item">Client Shiftwise Salary</a></li>
          <li><a href="<?php echo base_url('Reports/clientInvoiceList');?>" class="menu-item">Client Invoice List</a></li>
          <li><a href="<?php echo base_url('Reports/clientInvoiceListdatewise');?>" class="menu-item">Client Invoice List Datewise</a></li>   
          <li><a href="<?php echo base_url('Web/transaction');?>" class="menu-item">Transaction</a></li>
          <li><a href="<?php echo base_url('Web/transactionReports');?>" class="menu-item">Transaction Reports</a></li>
             
          <li><a href="<?php echo base_url('Reports/forHDFCBank');?>" class="menu-item">FOR HDFC</a></li>
           
           
          </ul>
        </li>
        <li class="nav-item"><a href="<?php echo base_url('branchadmin/UploadExcels/uploadHDFC');?>"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Upload HDFC</span></a>

        <?php }?>
      </ul>
    </div>
  </div>