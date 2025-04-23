using System.Data;
using System.Windows.Forms;
using Microsoft.Data.SqlClient;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.TreeView;

namespace lab13
{
    public partial class Form1 : Form
    {
        // connectionString-ийг нэг удаа тодорхойлно
        string connectionString = "Server=.\\SQLEXPRESS; Database=lab13_osan; User Id=sa; Password=admin123; TrustServerCertificate=True;";

        public Form1()
        {
            InitializeComponent();
            LoadData();  // Load data when form is initialized
        }

        private void LoadData()
        {
            using (SqlConnection con = new SqlConnection(connectionString))
            {
                con.Open();
                SqlCommand cmd = new SqlCommand("SELECT * FROM dbo.t_worker", con);
                SqlDataAdapter adapter = new SqlDataAdapter(cmd);
                DataTable table = new DataTable();
                adapter.Fill(table);
                dataGridView1.DataSource = table;
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            string name = textBox1.Text;
            string phone = textBox2.Text;
            string email = textBox3.Text;
            string mergejil = comboBox1.Text;
            DateTime ognoo = dateTimePicker1.Value;
            string huis = radioButton1.Checked ? "Эр" : (radioButton2.Checked ? "Эм" : "");
            string gHayag = richTextBox1.Text;
            string img = pictureBox1.ImageLocation ?? "";

            // Датаг SQL-д оруулах
            using (SqlConnection con = new SqlConnection(connectionString))
            {
                con.Open();
                string sql = @"
        INSERT INTO dbo.t_worker 
        ([name], [phone], [email], [ognoo], [mergejil], [huis], [img], [geriinHayag])
        VALUES 
        (@name, @phone, @email, @ognoo, @mergejil, @huis, @img, @geriinHayag)";

                using (SqlCommand cmd = new SqlCommand(sql, con))
                {
                    cmd.Parameters.AddWithValue("@name", name);
                    cmd.Parameters.AddWithValue("@phone", phone);
                    cmd.Parameters.AddWithValue("@email", email);
                    cmd.Parameters.AddWithValue("@ognoo", ognoo);
                    cmd.Parameters.AddWithValue("@mergejil", mergejil);
                    cmd.Parameters.AddWithValue("@huis", huis);
                    cmd.Parameters.AddWithValue("@img", img);  // Зураг замыг хадгална
                    cmd.Parameters.AddWithValue("@geriinHayag", gHayag);

                    cmd.ExecuteNonQuery();
                }
            }

            MessageBox.Show("Амжилттай нэмэгдлээ!", "Мэдээлэл", MessageBoxButtons.OK, MessageBoxIcon.Information);
            LoadData(); // Датаг шинэчилнэ

            // Цэвэрлэх хэсэг
            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            comboBox1.SelectedIndex = -1; // ComboBox-ийг хоослоно
            dateTimePicker1.Value = DateTime.Now; // Огноог одоогийн өдрөөр тохируулна
            radioButton1.Checked = false; // Эрэгтэй радио товчийг цуцална
            radioButton2.Checked = false; // Эмэгтэй радио товчийг цуцална
            pictureBox1.ImageLocation = ""; // Зургийг цэвэрлэнэ
            richTextBox1.Clear(); // RichTextBox-ийг хоослоно
        }

        private void button6_Click(object sender, EventArgs e)
        {
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Title = "Зураг сонгоно уу";
            openFileDialog.Filter = "Image Files|*.jpg;*.jpeg;*.png;*.bmp"; // зөвхөн зурагнууд

            if (openFileDialog.ShowDialog() == DialogResult.OK)
            {
                // Зураг сонгогдсон бол
                string originalPath = openFileDialog.FileName; // Зурагны зам
                string newFileName = Path.GetFileName(originalPath); // Зургийн нэр
                string destinationPath = Path.Combine(Application.StartupPath, "images", newFileName); // Шинэ зам, хуулсан газар

                // Хавтас байхгүй бол үүсгэнэ
                Directory.CreateDirectory(Path.Combine(Application.StartupPath, "images"));

                // Файлыг project руу хуулна
                File.Copy(originalPath, destinationPath, true); // true гэдэг нь байгаа файл дээр дахин бичих

                // PictureBox-д харуулах
                pictureBox1.ImageLocation = destinationPath;
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            string name = textBox1.Text;
            string phone = textBox2.Text;
            string email = textBox3.Text;
            string mergejil = comboBox1.Text;
            DateTime ognoo = dateTimePicker1.Value;
            string huis = radioButton1.Checked ? "Эр" : (radioButton2.Checked ? "Эм" : "");
            string gHayag = richTextBox1.Text;
            string img = pictureBox1.ImageLocation ?? "";

            // Сонгогдсон мөрийн ID авах
            int selectedRowIndex = dataGridView1.SelectedCells[0].RowIndex;
            int id = Convert.ToInt32(dataGridView1.Rows[selectedRowIndex].Cells["id"].Value); // "bid" биш "id"

            // Датаг SQL-д шинэчлэх
            using (SqlConnection con = new SqlConnection(connectionString))
            {
                con.Open();
                string sql = @"
        UPDATE dbo.t_worker 
        SET [name] = @name, 
            [phone] = @phone, 
            [email] = @email, 
            [ognoo] = @ognoo, 
            [mergejil] = @mergejil, 
            [huis] = @huis, 
            [img] = @img, 
            [geriinHayag] = @geriinHayag
        WHERE id = @id";

                using (SqlCommand cmd = new SqlCommand(sql, con))
                {
                    cmd.Parameters.AddWithValue("@name", name);
                    cmd.Parameters.AddWithValue("@phone", phone);
                    cmd.Parameters.AddWithValue("@email", email);
                    cmd.Parameters.AddWithValue("@ognoo", ognoo);
                    cmd.Parameters.AddWithValue("@mergejil", mergejil);
                    cmd.Parameters.AddWithValue("@huis", huis);
                    cmd.Parameters.AddWithValue("@img", img);  // Зураг замыг хадгална
                    cmd.Parameters.AddWithValue("@geriinHayag", gHayag);
                    cmd.Parameters.AddWithValue("@id", id); // Засах мөрийн ID

                    cmd.ExecuteNonQuery();
                }
            }

            MessageBox.Show("Амжилттай засагдлаа!", "Мэдээлэл", MessageBoxButtons.OK, MessageBoxIcon.Information);
            LoadData(); // Датаг шинэчилнэ

            textBox1.Clear();
            textBox2.Clear();
            textBox3.Clear();
            comboBox1.SelectedIndex = -1; // ComboBox-ийг хоослоно
            dateTimePicker1.Value = DateTime.Now; // Огноог одоогийн өдрөөр тохируулна
            radioButton1.Checked = false; // Эрэгтэй радио товчийг цуцална
            radioButton2.Checked = false; // Эмэгтэй радио товчийг цуцална
            pictureBox1.ImageLocation = ""; // Зургийг цэвэрлэнэ
            richTextBox1.Clear(); // RichTextBox-ийг хоослоно

        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0)
            {
                // Сонгогдсон мөрийн мэдээллийг авах
                DataGridViewRow row = dataGridView1.Rows[e.RowIndex];

                textBox1.Text = row.Cells["name"].Value.ToString(); // name
                textBox2.Text = row.Cells["phone"].Value.ToString(); // phone
                textBox3.Text = row.Cells["email"].Value.ToString(); // email
                comboBox1.Text = row.Cells["mergejil"].Value.ToString(); // mergejil
                dateTimePicker1.Value = Convert.ToDateTime(row.Cells["ognoo"].Value); // ognoo

                string huis = row.Cells["huis"].Value.ToString(); // huis
                if (huis == "Эр") radioButton1.Checked = true;
                else if (huis == "Эм") radioButton2.Checked = true;

                richTextBox1.Text = row.Cells["geriinHayag"].Value.ToString(); // geriinHayag
                pictureBox1.ImageLocation = row.Cells["img"].Value.ToString(); // img
            }
        }
        private void button3_Click(object sender, EventArgs e)
        {
            if (dataGridView1.SelectedCells.Count > 0)
            {
                int selectedRowIndex = dataGridView1.SelectedCells[0].RowIndex;
                int id = Convert.ToInt32(dataGridView1.Rows[selectedRowIndex].Cells["id"].Value);

                DialogResult result = MessageBox.Show("Та энэ мэдээллийг устгахдаа итгэлтэй байна уу?", "Баталгаажуулалт", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
                if (result == DialogResult.Yes)
                {
                    using (SqlConnection con = new SqlConnection(connectionString))
                    {
                        con.Open();
                        string sql = "DELETE FROM dbo.t_worker WHERE id = @id";

                        using (SqlCommand cmd = new SqlCommand(sql, con))
                        {
                            cmd.Parameters.AddWithValue("@id", id);
                            cmd.ExecuteNonQuery();
                        }
                    }

                    MessageBox.Show("Амжилттай устгалаа!", "Мэдээлэл", MessageBoxButtons.OK, MessageBoxIcon.Information);
                    LoadData(); // Устгасны дараа мэдээллийг шинэчилнэ
                }
            }
            else
            {
                MessageBox.Show("Устгах мөрөө сонгоно уу!", "Анхааруулга", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
        }

        private void button4_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {

        }
    }

}
