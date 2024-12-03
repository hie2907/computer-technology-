import json
import pymongo
import pandas as pd
from bson import ObjectId, Decimal128, Timestamp
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel

# Dữ liệu giả lập
product_data = {
  "productId": 6,
  "productName": "Sample Product",
  "categoryId": 1,
  "description": "This is a sample product",
  "price": 100,
  "stockQuantity": 10,
  "brandId": 1,
  "images": ["image1.jpg", "image2.jpg"],
  "dateAdded": "2023-01-01T00:00:00Z",
  "updated_at": "2023-01-01T00:00:00Z",
  "created_at": "2023-01-01T00:00:00Z"
}

# Kết nối đến MongoDB
client = pymongo.MongoClient("mongodb+srv://tranvanhieuvku1:tranvanhieu29072002@computerdl.ehd5f.mongodb.net/")
db = client["technology"]
products_collection = db["products"]

# Lấy dữ liệu sản phẩm từ MongoDB
products = list(products_collection.find({}))

# Chuyển đổi dữ liệu sản phẩm sang DataFrame
products_df = pd.DataFrame(products)
products_df['categoryId_str'] = 'category_' + products_df['categoryId'].astype(str)

# Chuyển đổi tất cả các cột Timestamp thành chuỗi
timestamp_columns = ['dateAdded', 'updated_at', 'created_at']
for column in timestamp_columns:
    if column in products_df.columns:
        products_df[column] = products_df[column].astype(str)

# Tạo ma trận TF-IDF cho các đặc trưng sản phẩm
tfidf = TfidfVectorizer(stop_words='english')
tfidf_matrix = tfidf.fit_transform(products_df['categoryId_str'])

# Tính toán ma trận tương đồng tuyến tính
cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)

def convert_types(obj):
    """Chuyển đổi ObjectId và Decimal128 thành chuỗi và số tương ứng"""
    if isinstance(obj, Decimal128):
        return float(obj.to_decimal())
    elif isinstance(obj, ObjectId):
        return str(obj)
    elif isinstance(obj, Timestamp):
        return obj.as_datetime().isoformat()  # Chuyển đổi Timestamp thành chuỗi datetime ISO format
    elif isinstance(obj, list):
        return [convert_types(item) for item in obj]
    elif isinstance(obj, dict):
        return {key: convert_types(value) for key, value in obj.items()}
    else:
        return obj

def get_recommendations(product_id, cosine_sim=cosine_sim):
    product_id = str(product_id)
    product_category = products_df.loc[products_df['productId'].astype(str) == product_id, 'categoryId'].values[0]

    # Lọc các sản phẩm cùng categoryId
    filtered_df = products_df[products_df['categoryId'] == product_category]
    filtered_indices = filtered_df.index.tolist()

    idx = products_df.index[products_df['productId'].astype(str) == product_id].tolist()[0]
    sim_scores = list(enumerate(cosine_sim[idx]))
    sim_scores = [score for score in sim_scores if score[0] in filtered_indices]
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)

    # Loại bỏ sản phẩm hiện tại ra khỏi danh sách các sản phẩm tương tự
    sim_scores = [score for score in sim_scores if products_df.iloc[score[0]]['productId'] != int(product_id)]

    sim_scores = sim_scores[:5]  # Lấy 5 sản phẩm tương tự nhất

    product_indices = [i[0] for i in sim_scores]
    recommended_products = products_df.iloc[product_indices].to_dict('records')

    # Chuyển đổi các kiểu dữ liệu không serializable thành kiểu dữ liệu tương ứng
    recommended_products = convert_types(recommended_products)
    return recommended_products

print("Hàm khuyến nghị đã sẵn sàng")

# Kiểm tra hàm khuyến nghị với dữ liệu giả lập
print(json.dumps(get_recommendations(product_data['productId']), indent=4))
