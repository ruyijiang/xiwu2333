
## 表单入库规则 ##


1. Info_setting.modal

    - **数字ID**（又UID）：**8位长度数字** - Int(8)
	- **用户名**（昵称）：**4-26位长度字符串** - Varchar(24)
	- **性别**：**必须是0或1、男或女** - Varchar(2)
	- 其余均属于常规验证，按常规执行即可


2. WriteBlog.modal

	- **文章内容**(仅验证纯文字，不算HTML标签、属性和值等等)： **120-9000个字符** - text


3. Login.modal
	
	- **密码**：**8-24位长度字符** - Varchar(24)
	- 其余属于常规验证，按常规执行即可


4. Signup.modal
	
	- 同上 


5. certification.modal（这页是用php嵌入式开发的，所以无法使用AngularValidation）
	- 均属于常规验证，按常规执行即可



