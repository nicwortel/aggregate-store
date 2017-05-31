# Aggregate Store

The goal of Aggregate Store is to be a simple yet effective PHP ORM for [domain-driven design][1] aggregates.

This is an experiment. Use this software at your own risk.

## Goals

 - To make it relatively easy to map between aggregates and database records (yes, I know, the [Vietnam of Computer
   Science][2])
 - To offer a simple collection-oriented repository interface (with methods like `add()`, `get()`, `remove()`), with a
   unit of work and changeset calculation behind the scenes
 - To avoid clutter / feature creep by keeping a narrow scope

## Scope / intended use case

The intended use case for this library is any PHP project that has to persist aggregates that are designed using the
tactical domain-driven design patterns. The use of CQRS (separation between write model and read model) is assumed.

Because of this, the following assumptions are made:
 - **Repositories** are being used to persist and retrieve (by ID) **aggregates**
 - **Aggregates** are composed of one or more **entities**, and may also contain **value objects**
 - All aggregates have one **root entity** (aggregate root) which *owns* all other elements inside the aggregate, and
   which will be persisted / retrieved by the repository
 - Aggregates only reference other aggregates by identity; not by having an object reference
 - Aggregates are designed to be relatively small; the full aggregate will be (eager) loaded into memory, there is no
   need for lazy loading
 - Aggregates form a transactional consistency boundary: all elements within a single aggregate must be persisted in a
   single (database) transaction

[1]: https://en.wikipedia.org/wiki/Domain-driven_design
[2]: https://blog.codinghorror.com/object-relational-mapping-is-the-vietnam-of-computer-science/
