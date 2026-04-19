---
id: ai-infra-llm-rag-gpu-architecture-20260419
type: knowledge
date: 2026-04-19
topics: [LLM, AI Infrastructure, RAG, GPU Computing, System Architecture, Vector Database]
tags: [llm, rag, embedding, gpu, incus, debian, ai-production, system-design]
source: conversation
---

# AI Production Infrastructure for LLM + RAG + GPU Systems

## Summary
AI production systems are not based on a single LLM, but on a modular architecture combining multiple specialized services. LLMs handle reasoning and chat, while separate components manage embeddings, vector search (RAG), voice processing, image processing, and tool execution. Production setups typically run on Linux (Debian/Ubuntu) with container or system isolation (e.g., Incus), and optionally GPU acceleration for inference-heavy workloads.

---

## Key Concepts

### 1. Modular AI Architecture
AI systems are composed of multiple independent services:
- LLM service (reasoning, chat, tool decisions)
- Embedding service (text ΓåÆ vector transformation)
- Vector database (semantic search for RAG)
- RAG service (retrieval + context assembly)
- Voice service (speech-to-text and text-to-speech)
- Image service (generation or vision processing)
- Tool router (API orchestration layer)

LLM acts as the controller, not the entire system.

---

### 2. Embedding vs LLM Separation
- LLM Γëá embedding model
- Embedding models are lightweight and used for semantic search
- Can be self-hosted (e.g., Ollama, sentence-transformers)
- Used to convert text into vector representations for similarity search

---

### 3. RAG Pipeline
Typical RAG flow:
1. User query received
2. Query converted into embedding
3. Vector database search (similar documents retrieved)
4. Context injected into prompt
5. LLM generates final response

---

### 4. GPU Usage in AI Systems
GPU is not required for all components:
- Required: LLM inference (large models), image generation, optional voice processing
- Not required: RAG logic, vector DB, gateway, small embeddings

GPU resources are typically assigned only to specific containers/services.

---

### 5. Infrastructure Design (Non-Docker Approach)
Production systems can be deployed without Docker using:
- Debian Linux host
- Incus container system
- systemd-managed services

Service separation:
- gateway (reverse proxy)
- llm service
- embedding service
- rag service
- vector database service

---

### 6. Gateway Layer
A reverse proxy (e.g., Angie or Nginx-compatible systems) is used for:
- Request routing
- TLS termination
- Rate limiting
- API security
- Streaming support for LLM responses

---

### 7. Hardware Requirements (General Guidance)
Depends on scale:

Minimum production:
- CPU: ~16 cores
- RAM: ~64 GB
- GPU: optional (small models only)
- Storage: NVMe SSD

Medium production (GPU-based):
- GPU: 24GB VRAM (e.g., RTX 4090 class)
- RAM: 64ΓÇô128 GB
- Multi-service separation required

---

## Implementation / Example code

### Ollama embedding API call
```bash
curl http://localhost:11434/api/embeddings \
  -d '{
    "model": "bge-m3",
    "prompt": "reset password laravel"
  }'
Example RAG flow (pseudo)
$query = "how to reset password";

// 1. embedding
$vector = embed($query);

// 2. vector search
$docs = pgvector_search($vector);

// 3. build context
$context = build_context($docs);

// 4. LLM call
$response = llm([
  "context" => $context,
  "question" => $query
]);

```
 Incus-based service layout
Debian Host
 ΓööΓöÇΓöÇ Incus
     Γö£ΓöÇΓöÇ gateway
     Γö£ΓöÇΓöÇ llm
     Γö£ΓöÇΓöÇ embedding
     Γö£ΓöÇΓöÇ rag
     Γö£ΓöÇΓöÇ vector-db
     ΓööΓöÇΓöÇ voice/image (optional)
