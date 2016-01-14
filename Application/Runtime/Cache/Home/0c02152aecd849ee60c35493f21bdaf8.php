<?php if (!defined('THINK_PATH')) exit();?> <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    
     <link rel="stylesheet" type="text/css" href="/Public/js/jquery/easyui/themes/default/easyui.css">
    <script type="text/javascript" src="/Public/js/jquery/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery/easyui/jquery.easyui.min.js"></script>	

    </head>
    <body style="background:#f1f5f8;">
    <div style="margin-top:0%;margin-left:25%;">
    <div onclick="javascript:location.href = '/index.php/Home/Schedule/show';" style="cursor:pointer;background: #5c7a29;color:white;font-family:Helvetica;font-size:14px;text-align:center;height:40px;width:100px;padding-top:15px;">
        返回首页
    </div>
    </div>
    <div style="margin-top:5%;margin-left:25%;">
        <table id="dg" title="教师管理" class="easyui-datagrid" style="width:700px;height:500px;"
                url="/index.php/Home/Teacher/show" 
                toolbar="#toolbar" 
                rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="teacherId" width="50">teacherId</th>
                    <th field="name" width="50">name</th>
                    <th field="mobile" width="50">mobile</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($teacherList)): foreach($teacherList as $key=>$vo): ?><tr>
                    <td field="teacherId" width="50"><?php echo ($vo["teacher_id"]); ?></td>
                    <td field="name" width="50"><?php echo ($vo["name"]); ?></td>
                    <td field="mobile" width="50"><?php echo ($vo["mobile"]); ?></td>
                    
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新建</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">修改</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">删除</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">教师信息</div>
        <form id="fm" method="post" novalidate>
            <input name="teacherId" class="easyui-textbox" type="hidden"/>
            <div class="fitem">
                <label>Name:</label>
                <input name="name" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>Mobile:</label>
                <input name="mobile" class="easyui-textbox">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('setTitle','新建');
            $('#fm').form('clear');
            url = 'saveTeacher';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','修改');
                $('#fm').form('load',row);
                url = 'updateTeacher';
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result == 'false'){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                      //  $('#dg').datagrid('reload');    // reload the user data
                        window.location.reload();
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            
            if (row){
                $.messager.confirm('Confirm','确定删除此教师？',function(r){
                    if (r){
                        $.post('deleteTeacher',{teacherId:row.teacherId},function(result){
                            if (result == 'ok'){
                            //    $('#dg').datagrid('reload');    // reload the user data
                                window.location.reload();
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
    <style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
    </style>
    </body>
 </html>