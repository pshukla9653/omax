<div data-scroll-to-active="true" class="main-menu menu-fixed menu-light menu-accordion menu-shadow">
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
              <li><a href="<?php echo base_url('branchadmin/Setting/addSubService');?>" class="menu-item">Sub Services Master</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/addClient');?>" class="menu-item">Client Master</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/clientList');?>" class="menu-item">Export/Import Client</a></li>
              <li><a href="<?php echo base_url('branchadmin/Setting/ClientServiceMap');?>" class="menu-item">Client Services Mapping</a></li>
           
          </ul>
        </li>
        
       <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Manage Employee</span></a>
          <ul class="menu-content">
          
              <li><a href="<?php echo base_url('branchadmin/Employee/create');?>" class="menu-item">Create Employee</a></li>
              <li><a href="<?php echo base_url('branchadmin/Employee/employeeList');?>" class="menu-item">Employees List</a></li>
              <li><a href="<?php echo base_url('branchadmin/Employee/MusterRollAttendance');?>" class="menu-item">Muster Roll Attendance</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/MusterRollAttendanceReport');?>" class="menu-item">Attendance Report</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/empList');?>" class="menu-item">Export/Import Employee</a></li>
           <li><a href="<?php echo base_url('branchadmin/Employee/generateSalary');?>" class="menu-item">Generate Salary</a></li>
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Manage Loan</span></a>
          <ul class="menu-content">
          
              
             <li><a href="<?php echo base_url('branchadmin/Employee/CreateLoan');?>" class="menu-item">Loan</a></li>
              <li><a href="<?php echo base_url();?>" class="menu-item">Report</a></li>
              
           
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Emp Shift</span></a>
          <ul class="menu-content">
          
              
             <li><a href="<?php echo base_url('branchadmin/Employee/ShiftEmp');?>" class="menu-item">Shift</a></li>
              <li><a href="<?php echo base_url();?>" class="menu-item">Report</a></li>
              
           
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">HR Department</span></a>
          <ul class="menu-content">
          
              <li><a href="<?php echo base_url('branchadmin/Hresource/applicationForm');?>" class="menu-item">Create Application</a></li>
              <li><a href="<?php echo base_url('branchadmin/Hresource/offerLetter');?>" class="menu-item">Offer Letter</a></li>
              <li><a href="<?php echo base_url('branchadmin/Hresource/confirmationLetter');?>" class="menu-item">Confirmation Letter</a></li>
              <li><a href="<?php echo base_url('branchadmin/Hresource/appointmentLetter');?>" class="menu-item">Appointment Letter</a></li>
              <li><a href="<?php echo base_url('branchadmin/Hresource/convertApplicantToEmployee');?>" class="menu-item">Applicant To Employee</a></li>
              
           
          </ul>
        </li>
        <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Reports</span></a>
          <ul class="menu-content">
          
              
             <li><a href="<?php echo base_url();?>" class="menu-item">EPF Report</a></li>
              <li><a href="<?php echo base_url();?>" class="menu-item">ESIC Report</a></li>
             
              
           
          </ul>
        </li>
        <?php }?>
      </ul>
    </div>
  </div>